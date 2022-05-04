// jQuery Carroussel auto
// let slideIndex = 0;
// showSlidesJquery();

// function showSlidesJquery(){
//     $('.mySlidesZ').each(function(){
//         $(this).hide();
//     });
//     slideIndex++;
//     if(slideIndex > $('.mySlidesZ').length-1){
//         slideIndex = 0
//     }
//     $('.mySlidesZ').eq(slideIndex).fadeIn(1000);

//     setTimeout(showSlidesJquery,2000) // Change les images toutes les 15 secondes
// }

// carrou auto

let slideIndex1 = 1;
showSlides1 ();

function showSlides1(){
        let slides = document.getElementsByClassName("mySlide");
    
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

