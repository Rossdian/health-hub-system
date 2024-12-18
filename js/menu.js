const mainhead = document.querySelector('.main-head');
const showcase = document.querySelector( '.showcase' );
const toggler = document.querySelector( '.toggler' );
const log_out = document.querySelector( '.log-out' );

toggler.addEventListener('click', function(){
    mainhead.classList.toggle( 'active' );
    showcase.classList.toggle( 'active' );
});

function openModal() {
  document.getElementById("logoutModal").style.display = "block";
}

function closeModal() {
  document.getElementById("logoutModal").style.display = "none";
}

function logout() {
  window.location.replace ("../Database/logout.php");
  closeModal(); 
}
