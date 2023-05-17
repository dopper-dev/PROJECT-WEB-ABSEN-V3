const messageForm = document.getElementById("message-form");
const messageInput = document.getElementById("message-input");
const messageContainer = document.getElementById("message-container");

const fetchMessages = () => {
  fetch("fetch.php")
    .then(response => response.json())
    .then(messages => {
      messageContainer.innerHTML = messages.map(message => `
        <p><strong>${message.sender} :</strong> ${message.message}</p>
      `).join("");
      // comment out this line to prevent scroll to bottom
      // messageContainer.scrollTop = messageContainer.scrollHeight;
    });
};

fetchMessages();

setInterval(fetchMessages, 1000);

const fetchUsername = () => {
  fetch("get-sender.php")
    .then(response => response.text())
    .then(username => {
      const sender = username.trim() !== "" ? username : "Anda";
      messageForm.addEventListener("submit", e => {
        e.preventDefault();

        const message = messageInput.value;

        if (message.trim() !== "") {
          fetch("insert.php", {
            method: "POST",
            body: new URLSearchParams({ sender, message })
          })
            .then(() => {
              messageInput.value = "";
              messageInput.focus();
            })
            .catch(error => console.error(error));
        }
      });
    });
};

fetchUsername();

const deleteOldMessages = () => {
  const now = new Date();
  const midnight = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 24, 0, 0);

  // calculate time difference between now and midnight
  const diff = midnight.getTime() - now.getTime();

  // set interval to run delete function at midnight
  setTimeout(() => {
    fetch("delete.php", {
      method: "POST",
      body: new URLSearchParams({ date: midnight.toISOString() })
    })
      .then(() => {
        console.log("Old messages deleted.");
      })
      .catch(error => console.error(error));
  }, diff);
};

// run function on page load to start the interval
deleteOldMessages();

// set interval to run function every 24 hours
setInterval(deleteOldMessages, 24 * 60 * 60 * 1000);
