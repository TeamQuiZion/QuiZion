document.addEventListener('DOMContentLoaded', () => {
    const buttons= document.querySelectorAll('.choice-btn');
    const toggleElement = document.getElementById('result');

    buttons.forEach(button => {
        button.addEventListener('click',function(){
            const selectedChoice =parseInt(this.dataset.choice);
            if(selectedChoice === correctAnswer) {
                
            }
        })
    });
});