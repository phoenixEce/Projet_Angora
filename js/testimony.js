function scrollReviews(direction) {
    const container = document.getElementById('reviewsContainer');
    const scrollAmount = 330; // card width + gap
    
    if (direction === 'left') {
        container.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    } else {
        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
}