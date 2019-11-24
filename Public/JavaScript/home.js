const like = document.getElementById('like');
const comment = document.getElementById('comment');

like.addEventListener('click', function() {
    alert('Veuillez vous connecter ou vous inscrire pour liker la photo.');
    console.log('like');
})

comment.addEventListener('click', function() {
    alert('Veuillez vous connecter ou vous inscrire pour commenter la photo.');
    console.log('comment');
})