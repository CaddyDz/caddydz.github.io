/* -- Glow effect -- */

const blur = document.getElementById("blur");
const article = document.getElementsByClassName("article");
// If there's an article (we're on the blog page)
if (article.length > 0) {
  blur.style.height = `${article[0].clientHeight + 710}px`;
} else {
  blur.style.height = "289vh";
}

const animateBlob = () => {
  window.onpointermove = (event) => {
    const { clientX, clientY } = event;
    console.log(`Horizontal: ${clientX}`);
    console.log(`Vertical: ${clientY}`);
    const blob = document.getElementById("blob");
    blob.style.display = "block";
    blob.animate(
      {
        left: `${clientX}px`,
        top: `${clientY}px`,
      },
      { duration: 3000, fill: "forwards" }
    );
  };
};

/*
  Only trigger the blob animation after document fully loaded.  This is
  necessary for cases where page load takes a significant length
  of time to fully load.
*/
if (document.readyState == "complete") {
  animateBlob();
} else {
  document.onreadystatechange = function () {
    if (document.readyState === "complete") {
      animateBlob();
    }
  };
}

/* -- Text effect -- */

const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

let interval = null;

document.querySelector(".text-effect").onmouseover = (event) => {
  let iteration = 0;

  clearInterval(interval);

  interval = setInterval(() => {
    event.target.innerText = event.target.innerText
      .split("")
      .map((letter, index) => {
        if (index < iteration) {
          return event.target.dataset.value[index];
        }

        return letters[Math.floor(Math.random() * 26)];
      })
      .join("");

    if (iteration >= event.target.dataset.value.length) {
      clearInterval(interval);
    }

    iteration += 1 / 3;
  }, 30);
};
