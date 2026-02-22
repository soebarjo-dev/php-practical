function toggleDropdown(){
    const dropdown = document.getElementById('profileDropdown')
    dropdown.classList.toggle('hidden')
}

window.addEventListener('click', function(e){
    const button = e.target.closest('button')
    const dropdown = document.getElementById('profileDropdown')

    if (!button && dropdown && !dropdown.contains(e.target)){
        dropdown.classList.add('hidden')
    }
})