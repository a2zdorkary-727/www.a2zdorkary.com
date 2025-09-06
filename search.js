document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    if(!searchForm) return;

    searchForm.addEventListener('submit', function(e){
        e.preventDefault();
        const query = this.querySelector('input[name="search"]').value.trim();
        if(query){
            // search results page-এ redirect
            window.location.href = "/product?search=" + encodeURIComponent(query);
        }
    });
});
