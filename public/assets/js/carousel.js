var slideIndex = 1;
showSlides(slideIndex); /* Next/Previous controls / function plusSlides(n) {     showSlides(slideIndex += n); }  /Thumbnail image controls */
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
// next previous control
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// carrou auto

let slideIndex1 = 1;
showSlides1 ();

function showSlides1(){
        let slides = document.getElementsByClassName("slide");
    
        for(let i =0; i< slides.length;i++){
            slides[i].style.display="none";
        }
        slideIndex1++;
        if(slideIndex1> slides.length){
            slideIndex1=1
        }
        slides[slideIndex1 -1].style.display="block";
    
        setTimeout(showSlides1, 5000); // changes d'images toutes les 2 secondes
    }