# PowerShell script to create deployment ZIP file for Hostinger
# Excludes unnecessary files and folders

$sourceFolder = "C:\xampp\htdocs\sim2-laravel"
$destinationZip = "C:\xampp\htdocs\lfhs-deployment.zip"

# Create temporary directory for files to zip
$tempFolder = "C:\xampp\htdocs\lfhs-temp-deploy"

Write-Host "Creating deployment package..." -ForegroundColor Green

# Remove temp folder if it exists
if (Test-Path $tempFolder) {
    Remove-Item -Path $tempFolder -Recurse -Force
}

# Create temp folder
New-Item -ItemType Directory -Path $tempFolder | Out-Null

# Define folders/files to EXCLUDE
$excludeItems = @(
    "node_modules",
    "vendor",
    ".env",
    ".git",
    ".gitignore",
    ".gitattributes",
    "*.md",
    "*.txt",
    "*.docx",
    ".env.example",
    ".env.production",
    "phpunit.xml",
    "tests",
    "storage\logs\*.log",
    "bootstrap\cache\*",
    "create-deployment-zip.ps1",
    "*.ps1"
)

Write-Host "Copying files (excluding unnecessary items)..." -ForegroundColor Yellow

# Copy all items except excluded ones
Get-ChildItem -Path $sourceFolder -Recurse | ForEach-Object {
    $relativePath = $_.FullName.Substring($sourceFolder.Length + 1)

    $shouldExclude = $false
    foreach ($pattern in $excludeItems) {
        if ($relativePath -like "*$pattern*") {
            $shouldExclude = $true
            break
        }
    }

    if (-not $shouldExclude) {
        $destination = Join-Path $tempFolder $relativePath

        if ($_.PSIsContainer) {
            if (-not (Test-Path $destination)) {
                New-Item -ItemType Directory -Path $destination -Force | Out-Null
            }
        } else {
            $destDir = Split-Path $destination -Parent
            if (-not (Test-Path $destDir)) {
                New-Item -ItemType Directory -Path $destDir -Force | Out-Null
            }
            Copy-Item $_.FullName -Destination $destination -Force
        }
    }
}

Write-Host "Creating ZIP file..." -ForegroundColor Yellow

# Remove existing ZIP if it exists
if (Test-Path $destinationZip) {
    Remove-Item $destinationZip -Force
}

# Create ZIP file
Compress-Archive -Path "$tempFolder\*" -DestinationPath $destinationZip -CompressionLevel Optimal

# Cleanup temp folder
Remove-Item -Path $tempFolder -Recurse -Force

Write-Host "✓ Deployment ZIP created successfully!" -ForegroundColor Green
Write-Host "Location: $destinationZip" -ForegroundColor Cyan
Write-Host ""
Write-Host "File size: $([math]::Round((Get-Item $destinationZip).Length / 1MB, 2)) MB" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Upload this ZIP file to Hostinger" -ForegroundColor White
Write-Host "2. Extract it in public_html" -ForegroundColor White
Write-Host "3. Follow deployment guide instructions" -ForegroundColor White
