find . -type f | shuf | rsync -avz --files-from=- --relative --exclude='.git' --exclude='node_modules' --exclude='vendor' ./ "/mnt/h$PWD/"
