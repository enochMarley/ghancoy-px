#!/bin/bash

# Hardcoded list of model names
MODELS=("Rank" "Personnel" "Stock" "Sale" "StockHistory")

# Loop through each model
for MODEL in "${MODELS[@]}"
do
  echo "Creating Laravel components for model: $MODEL"

  # # Create Model with Migration ,Controller, Seeder and Factory
  php artisan make:model "$MODEL" -mscf

  # # Create Policy
  php artisan make:policy "${MODEL}Policy" --model="$MODEL"

  # # Create Observer
  php artisan make:observer "${MODEL}Observer" --model="$MODEL"

  # # Create API Resource
  # php artisan make:resource "${MODEL}Resource"

  #Create API Collections
#   php artisan make:resource Collections/"${MODEL}Collection"

  # # Create Repositories
  # php artisan make:class Repositories/"${MODEL}Repository"

  # # Create Services
  # php artisan make:class Services/"${MODEL}Service"

  # # Create Requests
  # php artisan make:request "${MODEL}Request"

  echo "✅ Done: $MODEL"
  echo "--------------------------"
done

echo "🎉 All model components created successfully."
