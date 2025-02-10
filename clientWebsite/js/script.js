function add() {
    // Get input value
    const input = document.getElementById("input");
    const value = input.value;

    // Create single paragraph element
    const item = document.createElement("li");
    item.textContent = value;

    // Add to suggestion list
    document.getElementById("suggestion-list").appendChild(item);

    // Clear input field
    input.value = "";
}

// Handle button click
document.getElementById("button").addEventListener("click", add);