// script.js
const dropzone = document.getElementById('dropzone');

// Highlight the dropzone when a file is dragged over it
dropzone.addEventListener('dragenter', (event) => {
  event.preventDefault();
  dropzone.style.background = '#e2eaf3';
});

// Remove the highlighting when a file is dragged out of the dropzone
dropzone.addEventListener('dragleave', (event) => {
  event.preventDefault();
  dropzone.style.background = '';
});

// Prevent the browser from opening the file when it's dropped
dropzone.addEventListener('dragover', (event) => {
  event.preventDefault();
});

// Handle the file when it's dropped into the dropzone
dropzone.addEventListener('drop', (event) => {
  event.preventDefault();
  dropzone.style.background = '';

  const file = event.dataTransfer.files[0];
  const fileInput = document.getElementById('fileInput');
  fileInput.files = event.dataTransfer.files;
});