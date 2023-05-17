// Scroll to Top button
const scrollToTopBtn = document.querySelector(".scroll-to-top");
window.addEventListener("scroll", () => {
    if (window.pageYOffset > 100) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
});

// Hamburger menu
function toggleMenu() {
    $('#hamburger-menu').slideToggle();
}

// Search modal
$('.search-btn').click(function(){
    $('body').addClass('overflow-hidden');
    $('#search-modal-container').addClass('one');
    setTimeout(function() {
        $('.search-input .line').removeClass('hidden');
        $('.search-input input[type="text"]').focus();
        $('.search-input .line').addClass('active');
    },1000);
})

$('#search-close').click(function(){
    $('body').removeClass('overflow-hidden');
    $('#search-modal-container').removeClass('one');
    $('.search-input .line').addClass('hidden').removeClass('active');
});