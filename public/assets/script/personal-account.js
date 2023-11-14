const personalBtns = document.querySelector(".personal-profile-btns").querySelectorAll("span");
const contents = document
  .querySelector(".personal-account-content")
  .querySelectorAll(".personal-account-content-item");

personalBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (btn.id === 'personal-profile' || btn.id === 'personal-request-history') {
      document.querySelector('.personal-account-content-items').classList.add('my-profile-content')
    } else {
      document.querySelector('.personal-account-content-items').classList.remove('my-profile-content')      
    }
    const id = `personal-content${btn.id.split("personal")[1]}`;
    hideShowMyPersonaContent(id);
    btn.classList.toggle("active-personal-btn");
  });
});

function hideShowMyPersonaContent(contentId) {
  contents.forEach((content) => (content.style.display = "none"));
  personalBtns.forEach((btn) => btn.classList.remove("active-personal-btn"));
  document.getElementById(contentId).style.display = "block";
}
