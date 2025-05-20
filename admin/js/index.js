document.querySelectorAll(".nav-link").forEach(link => {
  const endpoint = link.dataset.load;
  const formEndpoint = link.dataset.form;

  if (endpoint) {
    link.addEventListener("click", e => {
      e.preventDefault();
      fetch(endpoint)
        .then(res => res.text())
        .then(html => {
          const content = document.getElementById("content");
          content.innerHTML = html;
        });
    });
  }
});