$ErrorActionPreference = "Stop"
$installDir = "$PSScriptRoot\bin\php"
$phpUrl = "https://windows.php.net/downloads/releases/archives/php-8.2.13-Win32-vs16-x64.zip" 

Write-Host "Cleaning up old installation..."
if (Test-Path "$installDir\php.zip") { Remove-Item "$installDir\php.zip" }
# Don't delete composer.phar if it exists

# Create Dir
if (!(Test-Path $installDir)) { New-Item -ItemType Directory -Path $installDir -Force | Out-Null }

$zipPath = "$installDir\php.zip"
Write-Host "Downloading PHP 8.2.13 (Archive) from $phpUrl..."
try {
    Invoke-WebRequest -Uri $phpUrl -OutFile $zipPath -UseBasicParsing
    Write-Host "Download complete."
}
catch {
    Write-Error "Download Failed! $_"
    exit 1
}

Write-Host "Extracting PHP..."
if (Test-Path $zipPath) {
    Expand-Archive -Path $zipPath -DestinationPath $installDir -Force
    Remove-Item $zipPath
}
else {
    Write-Error "Zip file not found!"
    exit 1
}

if (Test-Path "$installDir\php.exe") {
    Write-Host "SUCCESS: php.exe found!"
    
    # Re-apply config
    $iniFile = "$installDir\php.ini"
    Copy-Item "$installDir\php.ini-development" $iniFile -Force
    Add-Content -Path $iniFile -Value "extension_dir = `"$installDir\ext`""
    Add-Content -Path $iniFile -Value "extension=curl"
    Add-Content -Path $iniFile -Value "extension=mbstring"
    Add-Content -Path $iniFile -Value "extension=openssl"
    Add-Content -Path $iniFile -Value "extension=pdo_mysql"
    Add-Content -Path $iniFile -Value "extension=fileinfo"
    
    Write-Host "Configuration Updated."
    
    # Check Composer
    if (!(Test-Path "$installDir\composer.phar")) {
        Write-Host "Downloading Composer..."
        Invoke-WebRequest -Uri "https://getcomposer.org/composer.phar" -OutFile "$installDir\composer.phar"
    }

}
else {
    Write-Error "FATAL: php.exe still not found after extraction."
}
