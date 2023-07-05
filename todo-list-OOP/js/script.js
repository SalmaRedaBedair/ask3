document.addEventListener("DOMContentLoaded", function () {
  var closeButton = document.querySelector(".close");
  closeButton.addEventListener("click", function () {
    var errorMessage = document.querySelector(".error");
    errorMessage.parentNode.removeChild(errorMessage);
  });
});
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener("click", function () {
    checkbox.checked = !checkbox.checked;
    checkbox.value = checkbox.checked;
    var statusInput = checkbox.parentElement.querySelector(".status");
    statusInput.value = checkbox.checked ? "done" : "pending";
  });
});