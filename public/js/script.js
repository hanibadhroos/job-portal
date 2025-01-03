const registerAsCompanyButton = document.querySelector('.to_company');
const registerAsUserButton = document.querySelector('.to_user');
const companyForm = document.querySelector('.form-container:first-of-type');
const userForm = document.querySelector('.form-container:last-of-type');

registerAsCompanyButton.addEventListener('click', () => {
  companyForm.style.display = 'block';
  userForm.style.display = 'none';
});

registerAsUserButton.addEventListener('click', () => {
  userForm.style.display = 'block';
  companyForm.style.display = 'none';
});