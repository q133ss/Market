const dropdowns = document.querySelectorAll(".search-select");
const customInfoSelects = document.querySelectorAll(".custom-info-select");
const reviewBtn = document.getElementById("review");
const questionsBtn = document.getElementById("questions");
const writeReviewBtn = document.getElementById("write-review");
const body = document.body;
let controlMaxHeight = 40;
let searchControls = document.querySelector(".search-controls");
if (searchControls) {
  document
    .querySelector(".search-controls")
    .querySelectorAll(".search-select")
    .forEach((element) => {
      const ulHeight = element.querySelector(".options").clientHeight;
      if (ulHeight > controlMaxHeight) {
        controlMaxHeight = element.querySelector(".options").clientHeight;
      }
    });
}
const fileInput = document.getElementById("write-review-file-input");
const error = document.querySelector(".write-review-photo-error");
const tanksForm = document.getElementById("thenks-for-review");
const writeReviewForm = document.getElementById("write-review-form");
const thanks = document.querySelector(".thenks-for-review");
const addSizeModal = document.querySelector(".add-size-popup");
const addCharacteristicModal = document.querySelector(".add-characteristic-popup");
const addRowBtns = document.querySelectorAll(".add-row-btn");

const selectOption = (event) => {
  input.value = event.currentTarget.textContent;
};

const closeDropdownsFromOutside = () => {
  dropdowns.forEach((dropdown) => {
    if (dropdown.classList.contains("opened")) {
      dropdown.classList.remove("opened");
    }
  });
};

body.addEventListener("click", closeDropdownsFromOutside);

dropdowns.forEach((dropdown) => {
  const listOfOptions = dropdown.querySelectorAll(".option");
  const input = dropdown.querySelector("input");

  listOfOptions.forEach((option) => {
    option.addEventListener("click", (event) => {
      console.log(5555, event.currentTarget.id);
      input.value = event.currentTarget.textContent;

      if (event.currentTarget.id !== '') {
        showPersonalMobileContent(event.currentTarget.id)
      }
    });
  });

  dropdown.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdown.classList.toggle("opened");
    let controls = document.querySelector(".search-controls");
    if (controls) {
      controls = controls.querySelector(".swiper");
      if (dropdown.classList.contains("opened")) {
        controls.style.height = `${controlMaxHeight}px`;
      } else {
        controls.style.height = `40px`;
      }
    }
  });
});

customInfoSelects.forEach((select) => {
  const title = select.querySelector(".custom-info-select-title");
  title.addEventListener("click", () => {
    title.parentElement.classList.toggle("toggle-custom-select");
  });
});

if (reviewBtn && questionsBtn && writeReviewBtn) {
  reviewBtn.addEventListener("click", () => {
    removeReviewActives();
    reviewBtn.classList.toggle("active-review-btn");
    hideShowReviewContent("review-content");
  });

  questionsBtn.addEventListener("click", () => {
    removeReviewActives();
    questionsBtn.classList.toggle("active-review-btn");
    hideShowReviewContent("questions-content");
  });

  writeReviewBtn.addEventListener("click", () => {
    removeReviewActives();
    writeReviewBtn.classList.toggle("active-review-btn");
    hideShowReviewContent("write-review-content");
  });

  fileInput.addEventListener("change", (e) => {
    if (e.target.value !== "") {
      error.style.display = "none";
    }
  });

  // document
  //   .getElementById("write-review-submit")
  //   .addEventListener("click", (e) => {
  //     if (fileInput.value) {
  //       console.log(1111);
  //       error.style.display = "none";
  //     } else {
  //       console.log(222);
  //       error.style.display = "block";
  //       return;
  //     }
  //     writeReviewForm.style.display = "none";
  //     tanksForm.style.display = "flex";
  //   });
}

if (thanks) {
  thanks.querySelector("span").addEventListener("click", () => {
    writeReviewForm.style.display = "flex";
    tanksForm.style.display = "none";
  });
}

document.querySelectorAll(".cataloge-title").forEach((element) => {
  element.addEventListener("click", () => {
    element.classList.toggle("opened");
    if (element.classList.contains("opened")) {
      element.parentElement.style.height = "fit-content";
    } else {
      element.parentElement.style.height = "68px";
    }
  });
});

if (addRowBtns) {
  addRowBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.classList.contains('characteristic')) {
        addCharacteristicModal.style.display = "block";
        console.log(btn.parentElement);
        addCharacteristicModal.querySelector('#size-or-characteristic-div-id').value = btn.parentElement.querySelector('div').id
      } else {
        addSizeModal.querySelector('#size-or-characteristic-div-id').value = btn.parentElement.parentElement.id
        addSizeModal.style.display = "block";
      }
    })
  });
}

document.querySelectorAll('.add-size-or-characteristic-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const divList = document.querySelector(`#${btn.parentElement.querySelector('#size-or-characteristic-div-id').value}`)
    const div = document.createElement('div')
    const span = document.createElement('span')
    const button = document.createElement('button')
    button.innerText = 'Удалить'
    if (btn.parentElement.parentElement.classList.contains('add-size-popup')) {
      span.innerHTML = btn.parentElement.querySelector('.size').value
      button.classList.add('remove-product-size')
      div.appendChild(span)
      div.appendChild(button)
      divList.querySelector('div').prepend(div)
      addSizeModal.style.display = "none";
      addRemoveBtnClick('remove-product-size')
    } else if(btn.parentElement.parentElement.classList.contains('add-characteristic-popup')) {
      const p = document.createElement('p')
      const subDiv = document.createElement('div')
      div.classList.add('about-added-item')
      button.classList.add('remove-product-characteristic')
      span.innerHTML = btn.parentElement.querySelector('.parametr').value
      p.innerHTML = btn.parentElement.querySelector('.comment').value
      subDiv.appendChild(span)
      subDiv.appendChild(p)
      div.appendChild(subDiv)
      div.appendChild(button)
      console.log(555, divList);
      divList.prepend(div)
      addCharacteristicModal.style.display = "none";
      addRemoveBtnClick('remove-product-characteristic')
    }
  })
});

function addRemoveBtnClick(klass) {
  document.querySelectorAll(`.${klass}`).forEach(btn => {
    btn.addEventListener('click', () => {
      console.log();
      btn.parentElement.remove()
    })
  });
}

window.onclick = function(event) {
  if (event.target.id === 'modal') {
    addCharacteristicModal.style.display = "none";
    addSizeModal.style.display = "none";
  }
}

/**
 * =====================- functions -====================
 */
function removeReviewActives() {
  document.querySelectorAll(".review-btn").forEach((btn) => {
    btn.classList.remove("active-review-btn");
  });
}

function hideShowReviewContent(id) {
  if (id === "questions-content") {
    document.getElementById("questions-content").style.display = "block";
    document.getElementById("review-content").style.display = "none";
    document.getElementById("write-review-content").style.display = "none";
  } else if (id === "review-content") {
    document.getElementById("write-review-content").style.display = "none";
    document.getElementById("questions-content").style.display = "none";
    document.getElementById("review-content").style.display = "block";
  } else {
    document.getElementById("write-review-content").style.display = "block";
    document.getElementById("questions-content").style.display = "none";
    document.getElementById("review-content").style.display = "none";
  }
}

function showPersonalMobileContent(id) {
  const contents = document.querySelector('.personal-account-content-items').querySelectorAll('.personal-account-content-item')
  contents.forEach(content => content.style.display = 'none');
  const parent = document.getElementById(id)
  switch (id) {
     /**--------SELLER-------- */
    case "seller-products-page":
    document.getElementById('personal-content-products').style.display = 'block'
    document.getElementById('add-product').style.display = 'flex'
    break;

    case "seller-questions-page":
    document.getElementById('personal-content-questions').style.display = 'block'
    document.getElementById('add-product').style.display = 'flex'
    break;

    case "seller-statistic-page":
    document.getElementById('personal-content-statistics').style.display = 'block'
    document.getElementById('add-product').style.display = 'flex'
    break;

    case "seller-store-page":
    document.getElementById('personal-content-stores').style.display = 'block'
    document.getElementById('add-product').style.display = 'none'
    break;

    case "seller-reviews-page":
    document.getElementById('personal-content-reviews').style.display = 'block'
    document.getElementById('add-product').style.display = 'flex'
    break;

    case "seller-waiting-list-page":
    document.getElementById('personal-content-waiting-list').style.display = 'block'
    document.getElementById('add-product').style.display = 'none'
    break;

    /**--------MY PROFILE-------- */
    case "my-profile-settings-page":
    document.getElementById('personal-content-profile').style.display = 'block'
    parent.parentElement.parentElement.parentElement.nextElementSibling.classList.add('my-profile-content')
    break;

    case "my-search-history-page":
    document.getElementById('personal-content-request-history').style.display = 'block'
    parent.parentElement.parentElement.parentElement.nextElementSibling.classList.add('my-profile-content')
    break;

    case "my-reviews-page":
    document.getElementById('personal-content-my-reviews').style.display = 'block'
    parent.parentElement.parentElement.parentElement.nextElementSibling.classList.remove('my-profile-content')
    break;

    case "my-questions-page":
    document.getElementById('personal-content-my-questions').style.display = 'block'
    parent.parentElement.parentElement.parentElement.nextElementSibling.classList.remove('my-profile-content')
    break;

    case "my-waiting-list-page":
    document.getElementById('personal-content-my-waiting-list').style.display = 'block'
    parent.parentElement.parentElement.parentElement.nextElementSibling.classList.add('my-profile-content')
    break;

    /**--------ADMIN PROFILE-------- */
    case "admin-sellers-page":
    document.getElementById('personal-content-sellers').style.display = 'block'
    break;

    case "admin-moder-reviews-page":
    document.getElementById('personal-content-moder-reviews').style.display = 'block'
    break;

    case "admin-rating-page":
    document.getElementById('personal-content-rating').style.display = 'block'
    break;

    case "admin-adds-page":
    document.getElementById('personal-content-adds').style.display = 'block'
    break;

    case "admin-store-reviews-page":
    document.getElementById('personal-content-store-reviews').style.display = 'block'
    break;
  }
}
