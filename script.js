document.addEventListener("DOMContentLoaded", function () {

  // تأكيد الحذف (لكل أزرار الحذف)
  const deleteLinks = document.querySelectorAll("a[href*='delete'], form[onsubmit]");
  deleteLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      const confirmDelete = confirm("هل أنت متأكد أنك تريد حذف هذا العنصر؟");
      if (!confirmDelete) {
        e.preventDefault();
      }
    });
  });

  // التحقق من فورم التواصل contact.php
  const contactForm = document.querySelector(".contact-form-container form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      const name = contactForm.querySelector("input[name='name']").value.trim();
      const email = contactForm.querySelector("input[name='email']").value.trim();
      const message = contactForm.querySelector("textarea[name='message']").value.trim();

      if (!name || !email || !message) {
        alert("يرجى تعبئة جميع الحقول.");
        e.preventDefault();
      }
    });
  }

  // التحقق من login.php
  const loginForm = document.querySelector(".login-container form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const username = loginForm.querySelector("input[name='username']").value.trim();
      const password = loginForm.querySelector("input[name='password']").value.trim();

      if (!username || !password) {
        alert("يرجى إدخال اسم المستخدم وكلمة المرور.");
        e.preventDefault();
      }
    });
  }

});