var stonesDB = (function() {
    var tDB = {};
    var datastore = null;

    /**
     * Open a connection to the datastore.
     */
    tDB.open = function(callback) {
        // Database version.
        var version = 1;

        // Open a connection to the datastore.
        var request = indexedDB.open('stones', version);

        // Handle datastore upgrades.
        request.onupgradeneeded = function(e) {
            var db = e.target.result;

            e.target.transaction.onerror = tDB.onerror;

            // Delete the old datastore.
            if (db.objectStoreNames.contains('stone')) {
                db.deleteObjectStore('stone');
            }

            // Create a new datastore.
            var store = db.createObjectStore('stone', {
                keyPath: 'timestamp'
            });
        };

        // Handle successful datastore access.
        request.onsuccess = function(e) {
            // Get a reference to the DB.
            datastore = e.target.result;

            // Execute the callback.
            callback();
        };

        // Handle errors when opening the datastore.
        request.onerror = tDB.onerror;
    };
    /**
     * Fetch all of the stone items in the datastore.
     */
    tDB.fetchStones = function(callback) {
        var db = datastore;
        var transaction = db.transaction(['stone'], 'readwrite');
        var objStore = transaction.objectStore('stone');

        var keyRange = IDBKeyRange.lowerBound(0);
        var cursorRequest = objStore.openCursor(keyRange);

        var stones = [];

        transaction.oncomplete = function(e) {
            // Execute the callback function.
            callback(stones);
        };

        cursorRequest.onsuccess = function(e) {
            var result = e.target.result;

            if (!!result == false) {
                return;
            }

            stones.push(result.value);

            result.continue();
        };

        cursorRequest.onerror = tDB.onerror;
    };
    /**
     * Create a new todo item.
     */
    tDB.createStone = function(text, callback) {
        // Get a reference to the db.
        var db = datastore;

        // Initiate a new transaction.
        var transaction = db.transaction(['stone'], 'readwrite');

        // Get the datastore.
        var objStore = transaction.objectStore('stone');

        // Create a timestamp for the todo item.
        var timestamp = new Date().getTime();

        // Create an object for the todo item.
        var stone = {
            'text': text,
            'timestamp': timestamp
        };

        // Create the datastore request.
        var request = objStore.put(stone);

        // Handle a successful datastore put.
        request.onsuccess = function(e) {
            // Execute the callback function.
            callback(stone);
        };

        // Handle errors.
        request.onerror = tDB.onerror;
    };
    /**
     * Delete a todo item.
     */
    tDB.deleteStone = function(id, callback) {
        var db = datastore;
        var transaction = db.transaction(['stone'], 'readwrite');
        var objStore = transaction.objectStore('stone');

        var request = objStore.delete(id);

        request.onsuccess = function(e) {
            callback();
        }

        request.onerror = function(e) {
            console.log(e);
        }
    };


    // Export the tDB object.
    return tDB;
}());