const fs = require('fs');
const path = require('path');
const http = require('http');

const pages = [
  'index.php', 'about.php', 'appointment.php', 'blog.php', 'contact.php', 
  'designs.php', 'fabrics.php', 'gallery.php', 'pricing.php', 'services.php',
  'login.php', 'register.php'
];

const distDir = path.join(__dirname, 'dist-static');

// Create dist-static if not exists
if (!fs.existsSync(distDir)){
    fs.mkdirSync(distDir);
}

// Function to copy a directory recursively
function copyDirSync(src, dest) {
    if (!fs.existsSync(dest)) fs.mkdirSync(dest);
    const entries = fs.readdirSync(src, { withFileTypes: true });

    for (let entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);

        if (entry.isDirectory()) {
            copyDirSync(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

// Copy assets folder
const assetsSrc = path.join(__dirname, 'assets');
const assetsDest = path.join(distDir, 'assets');
if (fs.existsSync(assetsSrc)) {
    console.log('Copying assets...');
    copyDirSync(assetsSrc, assetsDest);
}

function fetchPage(page) {
    return new Promise((resolve, reject) => {
        http.get(`http://localhost:8000/${page}`, (res) => {
            let data = '';
            res.on('data', chunk => data += chunk);
            res.on('end', () => {
                // Replace all .php links in the HTML with .html
                let html = data.replace(/href="([^"]+)\.php([^"]*)"/g, 'href="$1.html$2"');
                
                // Determine output filename (index.php -> index.html)
                let outFile = page.replace('.php', '.html');
                fs.writeFileSync(path.join(distDir, outFile), html);
                console.log(`Saved ${outFile}`);
                resolve();
            });
        }).on('error', err => reject(err));
    });
}

async function buildAll() {
    console.log('Starting static build...');
    for (const page of pages) {
        try {
            await fetchPage(page);
        } catch (err) {
            console.error(`Failed to fetch ${page}:`, err);
        }
    }
    console.log('Build complete!');
}

buildAll();
