export const getQueryParams = () => {
    const urlParams = new URLSearchParams(window.location.search);
    return Object.fromEntries(urlParams.entries());
};

export const updateQueryAndFetch = (key, value) => {
    const urlParams = new URLSearchParams(getQueryParams());

    if (value) {
        urlParams.set(key, value);
    } else {
        urlParams.delete(key);
    }

    urlParams.delete('page');

    const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
    window.history.replaceState({}, '', newUrl);

    fetchDoctors(newUrl);
};

export const fetchDoctors = (url) => {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newDoctorsList = doc.querySelector('.doctors-list');
            const newPagination = doc.querySelector('nav');

            document.querySelector('.doctors-list').innerHTML = newDoctorsList.innerHTML;
            document.querySelector('nav').innerHTML = newPagination ? newPagination.innerHTML : '';
        })
        .catch(error => console.error('Error fetching doctors:', error));
};
