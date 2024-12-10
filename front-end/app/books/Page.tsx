'use client';

import React, { useEffect, useState } from 'react';

interface Book {
  id: number;
  title: string;
  author: string;
  isbn: string;
  category: string;
  available: boolean;
}

interface Worker {
  id: number;
  name: string;
  position: string;
  status: string;
}

interface SearchResults {
  books: {
    match: Book | null;
    related: Book[];
  };
  workers: {
    match: Worker | null;
    related: Worker[];
  };
}

export default function Page() {
  const [data, setData] = useState<{ books: Book[]; workers: Worker[] }>({ books: [], workers: [] });
  const [searchTerm, setSearchTerm] = useState('');
  const [searchType, setSearchType] = useState('all');
  const [searchResults, setSearchResults] = useState<SearchResults | null>(null);
  const [stats, setStats] = useState<any>(null);

  useEffect(() => {
    fetchAllData();
    fetchDashboardStats();
  }, []);

  const fetchAllData = async () => {
    try {
      const response = await fetch('/api/dashboard/all');
      const result = await response.json();
      if (result.status === 'success') {
        setData(result.data);
      }
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  const fetchDashboardStats = async () => {
    try {
      const response = await fetch('/api/dashboard/stats');
      const result = await response.json();
      setStats(result);
    } catch (error) {
      console.error('Error fetching stats:', error);
    }
  };

  const handleSearch = async () => {
    try {
      const response = await fetch(`/api/dashboard/search?search=${searchTerm}&type=${searchType}`);
      const result = await response.json();
      if (result.status === 'success') {
        setSearchResults(result.data);
      }
    } catch (error) {
      console.error('Error searching:', error);
    }
  };

  return (
    <div className="max-w-7xl mx-auto px-4 py-8">
      {/* Search Section */}
      <div className="mb-8 bg-white p-6 rounded-lg shadow">
        <h2 className="text-2xl font-bold mb-4">Search</h2>
        <div className="flex gap-4">
          <input
            type="text"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            placeholder="Search books or workers..."
            className="flex-1 p-2 border rounded"
          />
          <select
            value={searchType}
            onChange={(e) => setSearchType(e.target.value)}
            className="p-2 border rounded"
          >
            <option value="all">All</option>
            <option value="books">Books</option>
            <option value="workers">Workers</option>
          </select>
          <button
            onClick={handleSearch}
            className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Search
          </button>
        </div>
      </div>

      {/* Stats Dashboard */}
      {stats && (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <div className="bg-white p-4 rounded-lg shadow">
            <h3 className="font-bold text-lg">Total Books</h3>
            <p className="text-2xl">{stats.counts.books}</p>
          </div>
          <div className="bg-white p-4 rounded-lg shadow">
            <h3 className="font-bold text-lg">Active Workers</h3>
            <p className="text-2xl">{stats.counts.workers.active}</p>
          </div>
          <div className="bg-white p-4 rounded-lg shadow">
            <h3 className="font-bold text-lg">Categories</h3>
            <p className="text-2xl">{Object.keys(stats.categories).length}</p>
          </div>
          <div className="bg-white p-4 rounded-lg shadow">
            <h3 className="font-bold text-lg">Authors</h3>
            <p className="text-2xl">{Object.keys(stats.authors).length}</p>
          </div>
        </div>
      )}

      {/* Search Results */}
      {searchResults && (
        <div className="mb-8">
          <h2 className="text-2xl font-bold mb-4">Search Results</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {/* Books Results */}
            <div className="bg-white p-6 rounded-lg shadow">
              <h3 className="text-xl font-bold mb-4">Books</h3>
              {searchResults.books.match && (
                <div className="mb-4">
                  <h4 className="font-bold">Exact Match:</h4>
                  <div className="p-4 border rounded">
                    <p className="font-bold">{searchResults.books.match.title}</p>
                    <p>By: {searchResults.books.match.author}</p>
                  </div>
                </div>
              )}
              {searchResults.books.related.length > 0 && (
                <div>
                  <h4 className="font-bold">Related Results:</h4>
                  {searchResults.books.related.map((book) => (
                    <div key={book.id} className="p-4 border rounded mt-2">
                      <p className="font-bold">{book.title}</p>
                      <p>By: {book.author}</p>
                    </div>
                  ))}
                </div>
              )}
            </div>

            {/* Workers Results */}
            <div className="bg-white p-6 rounded-lg shadow">
              <h3 className="text-xl font-bold mb-4">Workers</h3>
              {searchResults.workers.match && (
                <div className="mb-4">
                  <h4 className="font-bold">Exact Match:</h4>
                  <div className="p-4 border rounded">
                    <p className="font-bold">{searchResults.workers.match.name}</p>
                    <p>Position: {searchResults.workers.match.position}</p>
                  </div>
                </div>
              )}
              {searchResults.workers.related.length > 0 && (
                <div>
                  <h4 className="font-bold">Related Results:</h4>
                  {searchResults.workers.related.map((worker) => (
                    <div key={worker.id} className="p-4 border rounded mt-2">
                      <p className="font-bold">{worker.name}</p>
                      <p>Position: {worker.position}</p>
                    </div>
                  ))}
                </div>
              )}
            </div>
          </div>
        </div>
      )}

      {/* All Data Lists */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="bg-white p-6 rounded-lg shadow">
          <h2 className="text-2xl font-bold mb-4">Books</h2>
          <div className="space-y-4">
            {data.books.map((book) => (
              <div key={book.id} className="p-4 border rounded">
                <h3 className="font-bold">{book.title}</h3>
                <p>Author: {book.author}</p>
                <p>ISBN: {book.isbn}</p>
                <p>Category: {book.category}</p>
                <p className={`font-bold ${book.available ? 'text-green-600' : 'text-red-600'}`}>
                  {book.available ? 'Available' : 'Checked Out'}
                </p>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white p-6 rounded-lg shadow">
          <h2 className="text-2xl font-bold mb-4">Workers</h2>
          <div className="space-y-4">
            {data.workers.map((worker) => (
              <div key={worker.id} className="p-4 border rounded">
                <h3 className="font-bold">{worker.name}</h3>
                <p>Position: {worker.position}</p>
                <p>Status: {worker.status}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}