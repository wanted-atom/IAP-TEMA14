let slide_index = 0;
slideshow();

function slideshow() {
    const slides = document.getElementsByClassName("slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slide_index++;
    if (slide_index > slides.length) {
        slide_index = 1;
    }
    slides[slide_index - 1].style.display = "block";
    setTimeout(slideshow, 6000)
}