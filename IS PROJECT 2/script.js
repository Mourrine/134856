const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnlogin-popup');
const iconClose = document.querySelector('.icon-close');




registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});





document.getElementById("appointmentForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const appointmentData = {
        name: formData.get("name"),
        email: formData.get("email"),
        date: formData.get("date"),
        time: formData.get("time"),
        doctor: formData.get("doctor")
    };
    fetch("appointment.php", {
        method: "POST",
        body: JSON.stringify(appointmentData),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("successMessage").style.display = "block";
        setTimeout(function() {
            window.location.href = "success_page.php?doctor=" + encodeURIComponent(appointmentData.doctor);
        }, 2000);
    })
    .catch(error => {
        // Handle any errors here
    });
});


       










