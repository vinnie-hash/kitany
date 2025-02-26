

document.addEventListener("DOMContentLoaded", function() {
  
  const navLinks = document.querySelectorAll(".nav-links a");
  navLinks.forEach(link => {
    link.addEventListener("click", function(event) {
      event.preventDefault();
      const targetId = this.getAttribute("href").split('#')[1];
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        window.scrollTo({ top: targetSection.offsetTop - 50, behavior: "smooth" });
      } else {
        
        window.location.href = this.getAttribute("href");
      }
    });
  });

 
  const quoteForm = document.getElementById("quoteForm");
  if (quoteForm) {
    quoteForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const phone = document.getElementById("phone").value;
      const location = document.getElementById("location").value;
      const details = document.getElementById("details").value;
      
      alert(`Thank you, ${name}! Your quote request has been submitted.`);
      
     
      
      this.reset();
    });
  }
  
  
  const inquiryForm = document.querySelector(".inquiry-form");
  if (inquiryForm) {
    inquiryForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const formData = new FormData(inquiryForm);
      
      fetch("submit_form.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        if (data.trim() === "success") {
          alert("Inquiry submitted successfully!");
          inquiryForm.reset();
        } else {
          alert("Submission failed. Please try again.");
        }
      })
      .catch(error => {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
      });
    });
  }
});
