burger= document.querySelector('.burger')
navbar= document.querySelector('.navbar')
ho= document.querySelector('.ho')
search_box= document.querySelector('.search_box')
wholenav= document.querySelector('.hnav')
height= document.querySelector('.height')



burger.addEventListener ('click',()=>{
    ho.classList.toggle('show');
    search_box.classList.toggle('show');
    navbar.classList.toggle('show');
    wholenav.classList.toggle('hnav');
    height.classList.toggle('height');


});
 


 