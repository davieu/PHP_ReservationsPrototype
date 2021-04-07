let toggleData = true;

function myFunction() {
  var x = document.querySelectorAll('.confirmationRow');
  var k = document.querySelectorAll('.emailRow');

  var emailRow = document.querySelectorAll('.emailRow');
  var confirmationRow= document.querySelectorAll('.confirmationRow');

  toggleData = !toggleData

  if (toggleData) {
    for (i = 0; i < k.length; i++) {
      confirmationRow[i].style.display = "block";
      emailRow[i].style.display = "none";
    };
  } else {
    for (i = 0; i < x.length; i++) {
      confirmationRow[i].style.display = "none";
      emailRow[i].style.display = "block";
    };
  }
};
