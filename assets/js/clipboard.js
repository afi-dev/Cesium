function copyClipboard() {
    
    document.getElementById('ip').select();
    document.getElementById('ip').setSelectionRange(0, 99999);
    document.execCommand("copy");
    navigator.clipboard.writeText(document.getElementById('ip').value);
    
}

document.getElementById("copy_ip").addEventListener("click", copyClipboard);