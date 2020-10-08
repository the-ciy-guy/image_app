const slideBtn = document.querySelector('.btn_slider');
const main = document.getElementById('main');
const sideMenu = document.getElementById('navbar_side_menu');
const closeBtn = document.querySelector('.btn_close');

slideBtn.addEventListener('click', () => {
    sideMenu.style.width = '250px';
    main.style.marginLeft = '250px';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.width = '0px';
    main.style.marginLeft = '0px';
})

// Fixed Navbar
const navbar = document.querySelector('.navbar');
const topLink = document.querySelector('.top_link');
window.addEventListener('scroll', () => {
    const scrollHeight = window.pageYOffset;
    const navHeight = navbar.getBoundingClientRect().height;
    if (scrollHeight > navHeight) {
        navbar.classList.add('fixed_nav');
    } else {
        navbar.classList.remove('fixed_nav');
    }

    if (scrollHeight > 500) {
        topLink.classList.add('show_link');
    } else {
        topLink.classList.remove('show_link');
    }
})

// FAQ Accordions
const accordion = document.querySelectorAll('.accordion');
for (var i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function(){
        this.classList.toggle('active');
        const panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

// Search FAQ
function searchFAQ()
{
    let searchInput = document.getElementById('faq_search').value;
    searchInput = searchInput.toLowerCase();
    let answer = document.querySelectorAll('.faq_search');

    for (let i = 0; i < answer.length; i++) {
        if (!answer[i].innerHTML.toLowerCase().includes(searchInput)) {
            answer[i].style.display = "none";
        } else {
            answer[i].style.display = "block";
        }
    }
}

// Image modal
var popImage = document.querySelectorAll('img[data-image]'), length = popImage.length, image;

for (var p = 0; p < length; p++) {
    image = popImage[p];
    image.addEventListener('click', (e) => {
        const info = e.currentTarget.dataset.image;
        myPopImage = document.querySelector("div[data-image=\"" + info + "\"].modal");
        myPopImage.style.display = 'block';
    });
    var span = document.getElementsByClassName("close");

    for (var x = 0; x < span.length; x++) {
        span[x].addEventListener('click', function(){
            this.parentElement.style.display = 'none';
        })
    }
}

// Download modal

var elems = document.querySelectorAll('button[data-index]'), len = elems.length, button;

for (var i = 0; i < len; i++) {
    button = elems[i];
    button.addEventListener('click', (e) => {
        const work = e.currentTarget.dataset.index;
        myModal = document.querySelector("div[data-index=\"" + work + "\"].modal");
        myModal.style.display = 'block';
    });
    var myBtn = document.getElementsByClassName('close_btn');
    
    for (var c = 0; c < myBtn.length; c++) {
        myBtn[c].addEventListener('click', function(){
            this.parentElement.style.display = 'none';
        })
    }
}

// Change url without page refresh
const newUrl = document.querySelectorAll('a[data-url]');
for (var u = 0; u < newUrl.length; u++) {
    var url = newUrl[u];
    url.addEventListener('click', (e) => {
        const pic_id = e.currentTarget.dataset.url;
        const gall = e.currentTarget.dataset.gallery;
        myUrl = document.querySelector("a[data-url=\"" + pic_id + "\"]");
        history.pushState({}, '', "?gallery_id=" + gall + "&picture_id=" + pic_id+"&");
    })
}

// Random picture on index page on page load
let pic_url = 'http://localhost/phpsandbox/php-con-to-pro/image_app/app.json';
let windows = document.querySelector('#search');
window.addEventListener('load', () => {
    fetch(pic_url)
    .then(picture => picture.json())
    .then(response => {
        let picArray = response;
        showPics(picArray);
    })
    .catch(err => console.log(err));
});

function showPics(picArray)
{
    const showcase = document.querySelector('.showcase');
    let randomPic = picArray[Math.floor(Math.random()*picArray.length)];
    let urlString = `gallery_pictures/${randomPic.picture}`;
    showcase.style.backgroundImage = 'url('+urlString+')';
}

