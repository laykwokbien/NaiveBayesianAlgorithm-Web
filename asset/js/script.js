const canvas = document.getElementById('canvas');
const img = document.getElementById('image');
const ctx = canvas.getContext('2d');

img.onload = function() {
    // Set the canvas size to match the image dimensions
    canvas.width = img.width;
    canvas.height = img.height;

    // Draw the image on the canvas
    ctx.drawImage(img, 0, 0);
};

canvas.addEventListener('click', function(event) {
    const rect = canvas.getBoundingClientRect();
    // Get the pixel coordinates relative to the canvas
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    // Get the pixel color data
    const pixel = ctx.getImageData(x, y, 1, 1).data;
    const rgb = `RGB(${pixel[0]}, ${pixel[1]}, ${pixel[2]})`;
    const hex = `#${((1 << 24) + (pixel[0] << 16) + (pixel[1] << 8) + pixel[2]).toString(16).slice(1)}`;

    // Display the color information
    document.getElementById('color').textContent = `Color: ${rgb} (${hex})`;
    document.getElementById('color').style.backgroundColor = hex;
});