// Tree Modal Functions
function openOptionModal() {
    document.getElementById('optionModal').classList.remove('hidden');
}

function closeOptionModal() {
    document.getElementById('optionModal').classList.add('hidden');
}

function openFormModal() {
    closeOptionModal();
    document.getElementById('popupModal').classList.remove('hidden');
}

function closeFormModal() {
    document.getElementById('popupModal').classList.add('hidden');
}

// Close modal when clicking outside
function setupModalCloseEvents() {
    const optionModal = document.getElementById('optionModal');
    const popupModal = document.getElementById('popupModal');

    window.onclick = function (event) {
        if (event.target === optionModal) {
            closeOptionModal();
        }
        if (event.target === popupModal) {
            closeFormModal();
        }
    }
}

// Initialize when document is loaded
document.addEventListener('DOMContentLoaded', function () {
    setupModalCloseEvents();

    // Add event listener to the tree link if it exists
    const treeLink = document.querySelector('.tree li a');
    if (treeLink) {
        treeLink.addEventListener('click', openOptionModal);
    }
});

// Optional: Keyboard support (ESC key to close modals)
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeOptionModal();
        closeFormModal();
    }
});