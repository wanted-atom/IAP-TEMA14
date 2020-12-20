const speed = 50;
let i = 0;
const text = "You won't know you're not in italy!";

type_writer()
function type_writer() {
    if (i < text.length) {
        document.getElementById("last").innerHTML += text.charAt(i);
        i++;
        setTimeout(type_writer, speed);
    }
}
