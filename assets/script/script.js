

function showlogin(){
    const loginbox = document.querySelector(".loginbox");
    loginbox.style.display ="flex";
    loginbox.style.opacity = 1;
    setTimeout(function(){
        const form = document.querySelector(".formlogin");
        form.style.transform = "translateY(0px)";
    }, 100)
}
function hidelogin(){
    const form = document.querySelector(".formlogin");
    form.style.transform = "translateY(-800px)";
    setTimeout(function(){
        const loginbox = document.querySelector(".loginbox");
        loginbox.style.opacity = 0;
        loginbox.style.display ="none";
    }, 200)
}

