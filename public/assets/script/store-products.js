document.querySelector('.add-store-review').addEventListener('click', (btn) => {
    const storeWritenReview = document.getElementById('store-writen-review')
    if (btn.target.classList.contains("opened")) {
      btn.target.classList.remove("opened");
      storeWritenReview.style.display = 'none'
    } else {
        btn.target.classList.toggle("opened");
        storeWritenReview.style.display = 'flex'
    }
  })
  