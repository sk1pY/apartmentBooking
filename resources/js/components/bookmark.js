document.querySelectorAll('.bookmark-button').forEach(button => {
    button.addEventListener('click', function () {
        let apartmentId = this.dataset.apartmentId;
        let bookmarkButton = this;
        let url = this.dataset.url;
        axios.post(url, {apartment_id: apartmentId})
            .then(response => {
                if (response.data.success) {
                    let icon = bookmarkButton.querySelector('i');
                    if (response.data.store) {
                        icon.classList.remove('bi-bookmark');
                        icon.classList.add('bi-bookmark-fill');
                    }else{
                        icon.classList.remove('bi-bookmark-fill');
                        icon.classList.add('bi-bookmark');
                    }
                }
            })
            .catch(error => console.error('Ошибка:', error));

    });
});
