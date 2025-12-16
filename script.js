

// Add a new field
let fieldCount = 0;

function addField() {
    fieldCount++;
    const container = document.getElementById('fields_container');
    if(!container) return;

    const div = document.createElement('div');
    div.className = 'field-box';
    div.id = 'field_' + fieldCount;

    div.innerHTML = `
        <hr>
        <label>Field Label:</label>
        <input type="text" name="fields[${fieldCount}][label]" required>

        <label>Field Type:</label>
        <select name="fields[${fieldCount}][type]" onchange="toggleOptions(this, ${fieldCount})">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="radio">Radio</option>
            <option value="checkbox">Checkbox</option>
            <option value="select">Dropdown</option>
        </select>

        <label>Options (comma separated for radio/checkbox/select):</label>
        <input type="text" name="fields[${fieldCount}][options]" id="options_${fieldCount}" disabled>

        <label>Required:</label>
        <input type="checkbox" name="fields[${fieldCount}][required]">

        <button type="button" onclick="removeField('field_${fieldCount}')">Remove Field</button>
    `;
    container.appendChild(div);
}


// Enable options input for certain types
function toggleOptions(select, id) {
    const optionsField = document.getElementById('options_' + id);
    if (['radio','checkbox','select'].includes(select.value)) {
        optionsField.disabled = false;
    } else {
        optionsField.disabled = true;
        optionsField.value = '';
    }
}

// Remove a field
function removeField(id) {
    const field = document.getElementById(id);
    field.parentNode.removeChild(field);
}

/* -------------------------
   Drag and Drop Reordering
--------------------------*/
let dragSrcEl = null;

function handleDragStart(e) {
    dragSrcEl = this;
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
    if (e.preventDefault) e.preventDefault();
    return false;
}

function handleDrop(e) {
    if (e.stopPropagation) e.stopPropagation();
    if (dragSrcEl != this) {
        dragSrcEl.innerHTML = this.innerHTML;
        this.innerHTML = e.dataTransfer.getData('text/html');
    }
    return false;
}

function addDragAndDrop() {
    const fields = document.querySelectorAll('#fields_container > div');
    fields.forEach(field => {
        field.addEventListener('dragstart', handleDragStart, false);
        field.addEventListener('dragover', handleDragOver, false);
        field.addEventListener('drop', handleDrop, false);
    });
}

// Call drag-and-drop setup on load and whenever a field is added
document.addEventListener('DOMContentLoaded', addDragAndDrop);
document.getElementById('fields_container')?.addEventListener('DOMNodeInserted', addDragAndDrop);
