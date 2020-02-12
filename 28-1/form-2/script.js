if (document.getElementById("displayinfo").checked) {
  document.getElementById("otherInfo").style.display = "block";
}
document.getElementById("otherInfo").style.display = "none";

document.getElementById("displayinfo").addEventListener("click", () => {
  if (document.getElementById("displayinfo").checked) {
    document.getElementById("otherInfo").style.display = "block";
  } else {
    document.getElementById("otherInfo").style.display = "none";
  }
});
