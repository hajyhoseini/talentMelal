document.addEventListener('DOMContentLoaded', () => {
    const contactButtons = document.querySelectorAll<HTMLButtonElement>('.contact-button');
    contactButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling as HTMLElement;
            if (answer) {
                answer.classList.toggle('hidden');
            }
        });
    });

    const faqQuestions = document.querySelectorAll<HTMLElement>('.faq-question');
    faqQuestions.forEach((question) => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling as HTMLElement;
            if (answer) {
                answer.classList.toggle('hidden');
            }
        });
    });
});
