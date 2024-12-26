import { UserTable } from './components/UserTable';

function App() {
  return (
    <div className="min-h-screen bg-gray-50 p-4">
      <div className="max-w-7xl mx-auto">
        <h1 className="text-3xl font-bold mb-8 text-center">User Management System</h1>
        <UserTable />
      </div>
    </div>
  )
}

export default App
