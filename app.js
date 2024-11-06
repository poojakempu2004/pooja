document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const studentName = document.getElementById('studentName').value;
    const course = document.getElementById('course').value;
    const feedback = document.getElementById('feedback').value;
    const rating = document.getElementById('rating').value;

    const feedbackData = {
        studentName: studentName,
        course: course,
        feedback: feedback,
        rating: rating
    };

    fetch('/submit-feedback', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(feedbackData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Feedback submitted successfully!');
            document.getElementById('feedbackForm').reset();
        } else {
            alert('Error submitting feedback');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting feedback');
    });
});
