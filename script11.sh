#!/bin/bash
id="67372c31f895d5d1b4d6c2a9"

    curl -X 'POST' \
        "https://hackeps-poke-backend.azurewebsites.net/events/$id" \
        -H 'accept: application/json' \
        -H 'Content-Type: application/json' \
        -d '{
        "team_id": "119f8619-cff7-4e3a-b956-553b9f2739ea"
    }'
