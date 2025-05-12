function validateForm() {
  const email = document.forms[0]["email"].value;
  const password = document.forms[0]["password"].value;
  if (!email || !password) {
    alert("All fields must be filled out!");
    return false;
  }
  return true;
}

