const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const loginE = document.querySelectorAll(".loginE");
const lhome = document.querySelectorAll(".lhome");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
    setTimeout(() => {
        if (loginE !== null) {
            loginE.forEach(login => {
                login.remove();
            });
        }
    }, 700);
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
    setTimeout(() => {
        if (loginE !== null) {
            loginE.forEach(login => {
                login.remove();
            });
        }
    }, 700);
});

lhome.forEach(home => {
    home.addEventListener("click", function() {
        location.href = "/";
    });
});
