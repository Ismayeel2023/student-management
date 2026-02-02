import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, router } from '@inertiajs/react';
import { route } from 'ziggy-js';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';

export default function Edit({ auth, student, courses }) {
    const { data, setData, post, processing, errors } = useForm({
        _method: 'PUT', // Spoof PUT for file upload support in Inertia/Laravel
        name: student.name,
        email: student.email,
        course_id: student.course_id,
        year: student.year,
        profile_picture: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('students.update', student.id)); // Using post method with _method: PUT
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Student</h2>}
        >
            <Head title="Edit Student" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <form onSubmit={submit} encType="multipart/form-data">
                                <div className="mb-4">
                                    <InputLabel htmlFor="profile_picture" value="Profile Picture" />
                                    {student.profile_picture && (
                                        <img src={`/storage/${student.profile_picture}`} alt="Current Profile" className="w-20 h-20 rounded-full object-cover mb-2" />
                                    )}
                                    <input
                                        id="profile_picture"
                                        type="file"
                                        name="profile_picture"
                                        className="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        onChange={(e) => setData('profile_picture', e.target.files[0])}
                                    />
                                    <InputError message={errors.profile_picture} className="mt-2" />
                                </div>

                                <div className="mb-4">
                                    <InputLabel htmlFor="name" value="Name" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        name="name"
                                        value={data.name}
                                        className="block mt-1 w-full"
                                        autoComplete="name"
                                        isFocused={true}
                                        onChange={(e) => setData('name', e.target.value)}
                                        required
                                    />
                                    <InputError message={errors.name} className="mt-2" />
                                </div>

                                <div className="mb-4">
                                    <InputLabel htmlFor="email" value="Email" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        name="email"
                                        value={data.email}
                                        className="block mt-1 w-full"
                                        autoComplete="email"
                                        onChange={(e) => setData('email', e.target.value)}
                                        required
                                    />
                                    <InputError message={errors.email} className="mt-2" />
                                </div>

                                <div className="mb-4">
                                    <InputLabel htmlFor="course_id" value="Course" />
                                    <select
                                        id="course_id"
                                        name="course_id"
                                        value={data.course_id}
                                        className="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full mt-1"
                                        onChange={(e) => setData('course_id', e.target.value)}
                                        required
                                    >
                                        <option value="" disabled>Select a course</option>
                                        {courses.map((course) => (
                                            <option key={course.id} value={course.id}>
                                                {course.name}
                                            </option>
                                        ))}
                                    </select>
                                    <InputError message={errors.course_id} className="mt-2" />
                                </div>

                                <div className="mb-4">
                                    <InputLabel htmlFor="year" value="Year" />
                                    <TextInput
                                        id="year"
                                        type="number"
                                        name="year"
                                        value={data.year}
                                        className="block mt-1 w-full"
                                        onChange={(e) => setData('year', e.target.value)}
                                        required
                                    />
                                    <InputError message={errors.year} className="mt-2" />
                                </div>

                                <div className="flex items-center justify-end mt-4">
                                    <PrimaryButton className="ml-4" disabled={processing}>
                                        Update
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
