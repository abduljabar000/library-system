export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body>
        <div className="min-h-screen">
          <header className="bg-slate-800 text-white p-4">
            <h1 className="text-2xl font-bold">Library Management</h1>
          </header>
          <main className="p-6">
            {children}
          </main>
          <footer className="bg-slate-100 p-4 text-center">
            <p>© 2024 Library Management System</p>
          </footer>
        </div>
      </body>
    </html>
  );
}
