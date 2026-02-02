import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, router } from '@inertiajs/react';
import { route } from 'ziggy-js'; // Corrected import
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useState } from 'react';

export default function Index({ auth, students }) {
    const { data, setData, get, processing } = useForm({
        search: new URLSearchParams(window.location.search).get('search') || '',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        get(route('students.index'));
    };

    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this student?')) {
            router.delete(route('students.destroy', id)); // Use router.delete
        }
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Students</h2>}
        >
            <Head title="Students" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="flex justify-between items-center mb-6">
                                <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100">Student List</h3>

                                <div className="flex gap-4">
                                    <form onSubmit={handleSearch} className="flex gap-2">
                                        <TextInput
                                            type="text"
                                            name="search"
                                            placeholder="Search..."
                                            value={data.search}
                                            onChange={(e) => setData('search', e.target.value)}
                                            className="block w-full"
                                        />
                                        <PrimaryButton type="submit" disabled={processing}>Search</PrimaryButton>
                                    </form>

                                    <Link
                                        href={route('students.create')}
                                        className="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                    >
                                        Add Student
                                    </Link>
                                </div>
                            </div>

                            {/* Flash Messages - displayed via layout or manually here if needed, but usually Layout handles it or global toast. For now, simple alert check if props passed, but actually flash is in page props */}

                            {students.data.length === 0 ? (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">No students found.</p>
                            ) : (
                                <>
                                    <div className="overflow-x-auto">
                                        <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead className="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Avatar</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Course</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Year</th>
                                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody className="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                {students.data.map((student) => (
                                                    <tr key={student.id}>
                                                        <td className="px-6 py-4 whitespace-nowrap">
                                                            {student.profile_picture ? (
                                                                <img src={`/storage/${student.profile_picture}`} alt="Avatar" className="w-10 h-10 rounded-full object-cover" />
                                                            ) : (
                                                                <div className="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                                                    <span className="text-xs">{student.name.charAt(0)}</span>
                                                                </div>
                                                            )}
                                                        </td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{student.name}</td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{student.email}</td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{student.course ? student.course.name : 'N/A'}</td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{student.year}</td>
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <Link
                                                                href={route('students.edit', student.id)}
                                                                className="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-4"
                                                            >
                                                                Edit
                                                            </Link>
                                                            <button
                                                                onClick={() => handleDelete(student.id)}
                                                                className="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600"
                                                            >
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>

                                    <div className="mt-4 flex justify-center">
                                        {/* Simplistic Pagination - rendering links manually or checking links array */}
                                        {students.links.map((link, key) => (
                                            link.url ? (
                                                <Link
                                                    key={key}
                                                    href={link.url}
                                                    className={`px-3 py-1 border rounded mx-1 ${link.active ? 'bg-indigo-500 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-300'}`}
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            ) : (
                                                <span
                                                    key={key}
                                                    className="px-3 py-1 border rounded mx-1 opacity-50 cursor-not-allowed bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            )
                                        ))}
                                    </div>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
