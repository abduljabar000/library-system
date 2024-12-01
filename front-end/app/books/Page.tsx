import React from 'react';

const BookList = ({ books }: { books: any }       ) => {
  return (
    <div className="book-list">
      <h2>Book List</h2>
      <div className="books-container">
        {books.map((books: any) => (
          <div key={books.id} className="book-card">
            <h3>{books.title}</h3>
            <p>Author: {books.author}</p>
            <p>ISBN: {books.isbn}</p>
            <p>Status: {books.available ? 'Available' : 'Checked Out'}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default BookList;