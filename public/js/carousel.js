var slideIndex = 1;
var slideIndexSm = 1;
showSlides(slideIndex);
showSlidesSm(slideIndexSm);

setInterval(() => { 
    plusSlides(1)
}, 10000);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
    showSlidesSm(slideIndexSm += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
    showSlidesSm(slideIndexSm = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" dot-active", "");
    }
    slides[slideIndex-1].style.display = "block"; 
    dots[slideIndex-1].className += " dot-active";
}

function showSlidesSm(n) {
    var i;
    var slides = document.getElementsByClassName("mySlidesSm");
    var dots = document.getElementsByClassName("dotSm");
    if (n > slides.length) {slideIndexSm = 1} 
    if (n < 1) {slideIndexSm = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" dot-active", "");
    }
    slides[slideIndexSm-1].style.display = "block"; 
    dots[slideIndexSm-1].className += " dot-active";
}