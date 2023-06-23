var searchIcon = document.querySelector('.fa-search');
var searchBar = document.getElementById('search-bar');
var closeBtn = document.querySelector('#search-bar button');

searchIcon.addEventListener('click', function() {
  searchBar.style.display = 'block';
});

closeBtn.addEventListener('click', function() {
  searchBar.style.display = 'none';
});
