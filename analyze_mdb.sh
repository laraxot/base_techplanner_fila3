#!/bin/bash

MDB_FILE="/home/zorin/Dropbox/SottanaRoberto/schei/Sorvegli01.mdb"

# Get list of tables
tables=$(mdb-tables -1 "$MDB_FILE")

echo "{"
echo "  \"tables\": ["
first_table=true

for table in $tables; do
    if [[ ! $table == MSys* ]]; then
        if [ "$first_table" = true ]; then
            first_table=false
        else
            echo "    },"
        fi
        
        echo "    {"
        echo "      \"name\": \"$table\","
        echo "      \"columns\": ["
        
        # Get schema for each table
        first_col=true
        while IFS='|' read -r col type size; do
            if [ "$first_col" = true ]; then
                first_col=false
            else
                echo ","
            fi
            echo -n "        {\"name\": \"$col\", \"type\": \"$type\", \"size\": $size}"
        done < <(mdb-schema "$MDB_FILE" "$table" | grep -E '^\s+[^)]' | sed -E 's/^\s+([^ ]+)\s+([^(]+)\(?([^)]*)\)?.*/\1|\2|\3/')
        echo
        echo "      ]"
    fi
done

echo "    }"
echo "  ]"
echo "}"
