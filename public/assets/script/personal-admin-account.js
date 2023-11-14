const personalBtns = document
  .querySelector(".admin-account-page")
  .querySelector(".personal-account-btns")
  .querySelectorAll("span");
const contents = document
  .querySelector(".admin-account-content")
  .querySelectorAll(".personal-account-content-item");
const bannerAction = document.querySelectorAll(".banner-action");

bannerAction.forEach((action) => {
  action.addEventListener("click", () => {
    action.classList.toggle("opened");
    if (action.classList.contains("opened")) {
      action.nextElementSibling.style.display = "flex";
    } else {
      action.nextElementSibling.style.display = "none";
    }
  });
});

document.querySelectorAll(".seller-products-btn").forEach((action) => {
  action.addEventListener("click", () => {
    action.classList.toggle("opened");
    const editProduct = document.getElementById("admin-edit-product-1");
    if (action.classList.contains("opened")) {
      editProduct.style.display = "flex";
    } else {
      editProduct.style.display = "none";
      document.getElementById("show-card-product-1").style.display = "none";
    }
  });
});

personalBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    console.log(4444);
    const id = `personal-content${btn.id.split("personal")[1]}`;
    hideShowPersonaAdminlContent(id);
    btn.classList.toggle("active-personal-btn");
  });
});

document.getElementById("add-admin-product").addEventListener("click", () => {
  hideShowPersonaAdminlContent("personal-content-add-admin-product");
});

document
  .querySelectorAll(".show-card-products")[0]
  .addEventListener("click", (btn) => {
    console.log(5555555);
    if (
      !btn.target.nextElementSibling.nextElementSibling.classList.contains(
        "opened"
      )
    ) {
      btn.target.nextElementSibling.nextElementSibling.classList.toggle(
        "opened"
      );
    }
    btn.target.classList.toggle("active-personal-btn");
    if (btn.target.classList.contains("active-personal-btn")) {
      document.getElementById("admin-edit-product-1").style.display = "none";
      document.getElementById("show-card-product-1").style.display = "flex";
    } else {
      document.getElementById("admin-edit-product-1").style.display = "flex";
      document.getElementById("show-card-product-1").style.display = "none";
    }
  });

function hideShowPersonaAdminlContent(contentId) {
  contents.forEach((content) => (content.style.display = "none"));
  if (contentId !== "personal-content-add-admin-product") {
    personalBtns.forEach((btn) => btn.classList.remove("active-personal-btn"));
  }
  console.log(contentId);
  document.getElementById(contentId).style.display = "block";
}
