let button = document.querySelectorAll('.dropdown-toggle1')
let menu = document.querySelectorAll('.dropdown-menu')
let container = document.querySelector('.container')
for(let i=0 ; i<button.length ; i++){
    
    button[i].addEventListener('click',()=>{
        
        if(menu[i].classList.contains('show')){
            menu[i].classList.remove('show')
        }else{
            menu.forEach(element => {
                element.classList.remove('show')
            });
            menu[i].classList.add('show')
    }
    
    })
}

function parallax_height() {
    var scroll_top = $(this).scrollTop();
    var sample_section_top = $(".sample-section").offset().top;
    var header_height = $(".sample-header-section").outerHeight();
    $(".sample-section").css({ "margin-top": header_height });
    $(".sample-header").css({ height: header_height - scroll_top });
  }
  parallax_height();
  $(window).scroll(function() {
    parallax_height();
  });
  $(window).resize(function() {
    parallax_height();
  });