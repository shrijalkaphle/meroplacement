const facebookbtn = document.querySelector('.facebook-btn')
const twitterbtn = document.querySelector('.twitter-btn')
const linkedinbtn = document.querySelector('.linkedin-btn')
let features = 'menubar=no,location=no,resizable=no,scrollbars=yes,status=no,height=500,width=500'
let posturl = ''
let posttitle = ''
function init() {
    posturl = encodeURI(document.location.href)
    posttitle = encodeURI('Hi everyone, please check this out: ')
}
init()
let facebooklink = `https://www.facebook.com/sharer.php?u=${posturl}`
let twitterlink = `https://twitter.com/share?url=${posturl}&text=${posttitle}`
let linkedinlink = `https://www.linkedin.com/shareArticle?url=${posturl}&title=${posttitle}`

facebookbtn.addEventListener('click', (ev) => {
    window.open(facebooklink, '_blank', features)
})
twitterbtn.addEventListener('click', (ev) => {
    window.open(twitterlink, '_blank', features)
})
linkedinbtn.addEventListener('click', (ev) => {
    window.open(linkedinlink, '_blank', features)
})